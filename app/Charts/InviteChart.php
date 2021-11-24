<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Support\Facades\DB;

class InviteChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $resul = DB::table('invites')
            ->select(DB::raw('id, created_at, day(created_at) as dia, month(created_at) as mes, count(id) as qtd'))
            ->where('user_id', auth()->id())
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        $chartisan = Chartisan::build()
            ->labels([]);

        foreach ($resul as $resulDay) {
            $chartisan->dataset($resulDay->dia . '/' . $resulDay->mes, [$resulDay->qtd]);
        }

        return $chartisan;
    }
}
