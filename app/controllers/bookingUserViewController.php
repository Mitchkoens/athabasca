<?php

class bookingUserViewController extends BaseController {
  
  public function index(){
     return 'nope';
 	 }

	public function getUserBookingDataTable(){
		$primaryUser = Session::get('userdata',NULL);
    	return Datatable::query(DB::table('booking') -> join('kits', 'booking.kitBarcode', '=', 'kits.barcode') -> where('primaryUser', $primaryUser->username))
    		->showColumns('eventname', 'datein', 'dateout', 'primaryUser' ,'forBranch', 'name')
            ->addColumn('Edit', function($model) {
            	$model->bookingID;
                return HTML::link('/viewuserbooking/'.$model->bookingID.'/edit/', 'Edit', array('class' => 'btn btn-default'));
            })
            ->addColumn('Delete', function($model) {
            	$model->bookingID;
  				return HTML::link('/delete/'.$model->bookingID.'/edit/', 'Delete', array('class' => 'btn btn-default'));
            })
        	->searchColumns('eventname', 'datein', 'dateout', 'primaryUser' ,'forBranch', 'name')
        	->orderColumns('eventname', 'datein', 'dateout', 'primaryUser', 'forBranch', 'name')
        	->make();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
	    $users = Session::get('userdata',NULL);
	    if($users == NULL){
	        return Redirect::to('/');
	    }
    	$table = Datatable::table()
      	->addColumn('Event Name', 'Date In', 'Date Out', 'Primary Recipient', 'Branch', 'Kit Type' ,'Edit' ,'Delete')
      	->setUrl(route('api.userbooking'))
      	->noScript();
    	return View::make('viewUserBooking', array('table' => $table));
  }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
    $data = DB::table('booking')->where('bookingID', $id)->first();
    //dd($data);
    return View::make('transfers.edit')->with('data', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
    //
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}