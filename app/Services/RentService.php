<?php

namespace App\Services;

use App\Models\Rents;

class RentService
{
    /**
     * @throws \Exception
     */
    public function create(array $rent_data): Rents
    {
        $rest = Rents::create($rent_data);

        if (!$rest)
            throw new \Exception('Error at save rent');

        return $rest;
    }

    /**
     * @throws \Exception
     */
    public function update(int $id, array $rent_data): Rents
    {
        $rent = Rents::find($id);

        if (!$rent->update($rent_data))
            throw new \Exception('Error at updating rent');

        return $rent;
    }

    /**
     * @throws \Exception
     */
    public function updateRentsStatus()
    {
        $rents = $this->getLateRents();

        foreach ($rents as $rent)
        {
            if (!$rent->update(['status' => 'late']))
                throw new \Exception("error in update rent status to late");
        }
    }

    private function getLateRents()
    {
        return Rents::whereRaw('lease_end_date < CURRENT_TIMESTAMP()')
            ->whereNotIn('status', array('finished', 'late'))
            ->get();
    }

    public function paginatedRentals(int $count): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Rents::with(['product', 'customer'])
            ->orderBy('id', 'DESC')
            ->paginate($count);
    }
}
