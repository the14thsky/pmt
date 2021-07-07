<?php

namespace App\Http\Controllers\Sales;

use App\DataTables\Administration\CustomerDataTable;
use App\Http\Requests\Administration;
use App\Http\Requests\Administration\CreateCustomerRequest;
use App\Http\Requests\Administration\UpdateCustomerRequest;
use App\Repositories\Sales\CustomerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Country;
use App\Models\Industry;
use Response;

class CustomerController extends AppBaseController
{
    /** @var  CustomerRepository */
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param CustomerDataTable $customerDataTable
     * @return Response
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        return $customerDataTable->render('administration.customers.index');
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::pluck('country_name', 'id');
        $industries = Industry::pluck('industry_name', 'id');
        return view('administration.customers.create')
            ->with('countries', $countries)
            ->with('industries', $industries)
        ;
    }

    /**
     * Store a newly created Customer in storage.
     *
     * @param CreateCustomerRequest $request
     *
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = auth('sanctum')->user()->id;
        $customer = $this->customerRepository->create($input);

        Flash::success('Customer saved successfully.');

        return redirect(route('sales.customers.index'));
    }

    /**
     * Display the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('sales.customers.index'));
        }

        return view('administration.customers.show')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified Customer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $customer = $this->customerRepository->find($id);
        $countries = Country::pluck('country_name', 'id');
        $industries = Industry::pluck('industry_name', 'id');

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('sales.customers.index'));
        }

        return view('administration.customers.edit')
            ->with('customer', $customer)
            ->with('countries', $countries)
            ->with('industries', $industries)
            ;
    }

    /**
     * Update the specified Customer in storage.
     *
     * @param  int              $id
     * @param UpdateCustomerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCustomerRequest $request)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('sales.customers.index'));
        }

        $customer = $this->customerRepository->update($request->all(), $id);

        Flash::success('Customer updated successfully.');

        return redirect(route('sales.customers.index'));
    }

    /**
     * Remove the specified Customer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('sales.customers.index'));
        }

        $this->customerRepository->delete($id);

        Flash::success('Customer deleted successfully.');

        return redirect(route('sales.customers.index'));
    }
}
