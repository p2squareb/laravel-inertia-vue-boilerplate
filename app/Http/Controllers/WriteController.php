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

        return Inertia::render('Write/BasicList');
    }

    /*public function getWrites($tableId, $searchKind, $searchString)
    {
        $query = BoardWrite::where('table_id', $tableId)->where('is_delete', 0)->where('is_notice', 0);

        if (!empty($this->searchString)) {
            if ($this->searchKind !== ''){
                $query->where($this->searchKind, 'like', '%'.$this->searchString.'%');
            }else{
                $query->where(function ($query) {
                    $query->where('subject', 'like', '%'.$this->searchString.'%')
                        ->orWhere('content', 'like', '%'.$this->searchString.'%');
                });
            }
        }

        if (!empty($this->pagePeriod)) {
            if ($this->pagePeriod === '7' || $this->pagePeriod === '30') {
                $query->where('created_at', '>=', Carbon::now()->subDays($this->pagePeriod));
            }else if ($this->pagePeriod === '3m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(3));
            }else if ($this->pagePeriod === '6m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
            }else if ($this->pagePeriod === '1y') {
                $query->where('created_at', '>=', Carbon::now()->subYear());
            }
        }

        if (!empty($this->category)) {
            $query->where('categories', $this->category);
        }

        if (empty($this->pageOrder)) $this->pageOrder = 'created_at';
        if ($this->pageOrder === 'rate') {
            $query->orderByRaw("(rate_up - rate_down) desc");
        }elseif ($this->pageOrder === 'comment') {
            $query->orderBy('comment_count', 'desc');
        }else{
            $query->orderBy($this->pageOrder, 'desc');
        }

        if ($this->board->skin === 'gallery') {
            $this->pageRows = 18;
        }else if ($this->board->skin === 'faq') {
            $this->pageRows = 1000;
        }
        if (empty($this->pageRows)) $this->pageRows = 15;

        return $query->orderBy('id', 'desc')->paginate($this->pageRows);
    }*/
}
