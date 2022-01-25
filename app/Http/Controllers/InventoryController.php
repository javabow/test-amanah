<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use DataTables;

class InventoryController extends Controller
{
    public function index()
    {
        return view("backend_mazer.dashboard.inventory");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getDataId(Request $request)
    {
        $validatedData = $request->validate([
            'edit_id' => ['required', 'numeric'],
        ]);

        if ($haha = Inventory::whereId($request->edit_id)->get()) {
            return response()->json(array('success' => true, 'data' => $haha), 200);
        } else {
            return response()->json(array('success' => false), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'harga' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'nama_barang' => ['required'],
        ]);

        $add_inventory = new Inventory;
        $add_inventory->harga = $request->harga;
        $add_inventory->stok = $request->stok;
        $add_inventory->nama_barang = $request->nama_barang;

        if ($add_inventory->save()) {
            return response()->json(array('success' => true, 'last_insert_id' => $add_inventory->id), 200);
        } else {
            return response()->json(array('success' => false), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        $invent = Inventory::get();
        // return $haha;
        return Datatables::of($invent)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validatedData = $request->validate([
            'harga' => ['required', 'numeric'],
            'stok' => ['required', 'numeric'],
            'nama_barang' => ['required'],
        ]);

        try {
            $up_inventory = Inventory::FindOrFail($request->id);

            $up_inventory->update($request->all());

            return response()->json(array('success' => true, 'last_update_id' => $up_inventory->id), 200);
        } catch (\Exception $e) {
            return response()->json(array('success' => false), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
