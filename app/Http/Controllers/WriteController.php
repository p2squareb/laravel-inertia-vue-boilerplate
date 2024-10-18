<?php

namespace App\Http\Controllers;

use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WriteController extends Controller
{
    use BoardConfig;

    public function list(Request $request, $tableId)
    {
        $board = $this->getBoard($tableId);

        $baseLevel = 0; $isWrite = false;
        if(auth()->check()) {
            $baseLevel = auth()->user()->group_level;
        }
        if($baseLevel >= $board->write_level) {
            $isWrite = true;
        }

        return Inertia::render('Write/List', [
            'board' => $board,
            'notice' => $this->getNoticeWrites($tableId),
            'write' => $this->getWrites($board->skin, $tableId, $request->searchKind, $request->searchString),
            'isWrite' => $isWrite,
        ]);
    }

    public function getWrites($boardSkin, $tableId, $searchKind, $searchString)
    {
        $query = BoardWrite::where('table_id', $tableId)->where('is_delete', 0)->where('is_notice', 0);

        if (!empty($searchString)) {
            if ($searchKind !== ''){
                $query->where($searchKind, 'like', '%'.$searchString.'%');
            }else{
                $query->where(function ($query) use ($searchString) {
                    $query->where('subject', 'like', '%'.$searchString.'%')
                        ->orWhere('content', 'like', '%'.$searchString.'%');
                });
            }
        }

        if (!empty($pagePeriod)) {
            if ($pagePeriod === '7' || $pagePeriod === '30') {
                $query->where('created_at', '>=', Carbon::now()->subDays($pagePeriod));
            }else if ($pagePeriod === '3m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(3));
            }else if ($pagePeriod === '6m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
            }else if ($pagePeriod === '1y') {
                $query->where('created_at', '>=', Carbon::now()->subYear());
            }
        }

        if (!empty($category)) {
            $query->where('categories', $category);
        }

        if (empty($pageOrder)) $pageOrder = 'created_at';
        if ($pageOrder === 'rate') {
            $query->orderByRaw("(rate_up - rate_down) desc");
        }elseif ($pageOrder === 'comment') {
            $query->orderBy('comment_count', 'desc');
        }else{
            $query->orderBy($pageOrder, 'desc');
        }

        if ($boardSkin === 'gallery') {
            $pageRows = 18;
        }else if ($boardSkin === 'faq') {
            $pageRows = 1000;
        }
        if (empty($pageRows)) $pageRows = 15;

        return $query->orderBy('id', 'desc')->paginate($pageRows);
    }

    public function getNoticeWrites($tableId)
    {
        return BoardWrite::where('table_id', $tableId)->where('is_delete', 0)->where('is_notice', 1)->orderBy('id', 'desc')->limit(3)->get();
    }
}
