<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = Car::where('active_status', 1)->orderBy('updated_at', 'desc')->get();
        $count =count($car);
        return view('car',compact('car','count'));
        return view('car');
    }

    public function carList(Request $request)
    {
        if ($request->ajax()) {
            $car = Car::where('active_status', 1)->orderBy('updated_at', 'desc')->get();
            // return DataTables::of($car)->make(true);
            return Datatables::of($car)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_car');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create
        $car = new Car;
        $car->brand = $request->get('brand');
        $car->model = $request->get('model');
        $car->color = $request->get('color');
        $car->year = $request->get('year');
        $car->latitude = $request->get('latitude');
        $car->longitude = $request->get('longitude');
        $image = $request->file('image');
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/img');
        $image->move($destinationPath, $input['imagename']);
        $car->image = $input['imagename'];
        $car->active_status = 1;
        $car->user_id = Auth::user()->id;
        $car->save();
        return redirect('car')->with('success', 'Car added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return view('edit_car', compact('car', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update
        $car = Car::find($id);
        $car->brand = $request->get('brand');
        $car->model = $request->get('model');
        $car->color = $request->get('color');
        $car->year = $request->get('year');
        $car->latitude = $request->get('latitude');
        $car->longitude = $request->get('longitude');
        if ($request->file('image') != '') {
            $image = $request->file('image');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $input['imagename']);
            $car->image = $input['imagename'];
        }
        $car->active_status = 1;
        $car->user_id = Auth::user()->id;
        $car->save();
        return redirect('car')->with('success', 'Car updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->active_status = 0;
        $car->save();
        return redirect('car')->with('error', 'Car deleted successfully');
    }
}
