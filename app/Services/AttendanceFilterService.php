<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceFilterService
{
    public string $name;
    public int $year;
    public int $month;
    public Carbon $from;
    public Carbon $to;

    public function __construct(Request $request)
    {
        $this->name  = (string) ($request->get('name') ?? '');
        $this->year  = (int) $request->get('year', now()->year);
        $this->month = (int) $request->get('month', now()->month);

        $defaultFrom = Carbon::createFromDate($this->year, $this->month, 1)->startOfDay();
        $defaultTo   = Carbon::createFromDate($this->year, $this->month, 1)->endOfMonth()->endOfDay();

        $this->from = $request->filled('from') ? Carbon::parse($request->from)->startOfDay() : $defaultFrom;
        $this->to   = $request->filled('to')   ? Carbon::parse($request->to)->endOfDay()     : $defaultTo;
    }

    public function getDaysRange(): array
    {
        $start = $this->from->copy()->startOfDay();
        $end   = $this->to->copy()->startOfDay();

        $days = [];
        while ($start->lte($end)) {
            $days[] = $start->toDateString();
            $start->addDay();
        }
        return $days;
    }

    public function getMonthsList(): \Illuminate\Support\Collection
    {
        return collect(range(1, 12))->map(function ($m) {
            return [
                'number' => $m,
                'name'   => Carbon::createFromDate($this->year, $m, 1)->translatedFormat('F'),
            ];
        });
    }

    public function fromString(): string
    {
        return $this->from->toDateString();
    }

    public function toString(): string
    {
        return $this->to->toDateString();
    }
}
