<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{
    /**
     * Get customers list
     * @return object
     */
    public function getCustomers(): object
    {

        $customer = new Customer();

        $customersList = $customer->orderBy('id', 'asc')->paginate(50);

        return view('customers/view', [
            'customers' => $customersList
        ]);
    }

    /**
     * Get customers list by company ID
     * @param int $companyId
     * @return object
     */
    public function getCustomersByCompanyId(int $companyId): object
    {
        if (isset($companyId)) {
            $getCustomersById = Customer::where('company_id', $companyId)->orderBy('id', 'asc')->paginate(50);

            $getCompanyName = Company::where('id', $companyId)->get();

            return view('customers/search_by_company', [
                'customers' => $getCustomersById,
                'company_id' => $companyId,
                'company_name' => $getCompanyName
            ]);
        } else {
            return redirect()->route('companies.view')->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Get view for create customer
     * @return object
     */
    public function createCustomerView(): object
    {
        return view('customers/create');
    }

    /**
     * Create new customer
     * @param CustomerRequest $request
     * @return object
     */
    public function createCustomer(CustomerRequest $request): object
    {
        if (!empty($request->name)) {

            if (!empty($request->company_name)) {
                $getCompany = Company::where('company_name', $request->company_name)->get();
            }
            if (isset($getCompany[0]->id)) {

                $companyId = $getCompany[0]->id;

                $customer = new Customer([
                    'name' => $request->name,
                    'company_id' => $companyId
                ]);
                $customer->save();

                return redirect()->back()->with('success', 'User created');
            } else {

                $customer = new Customer([
                    'name' => $request->name,
                ]);
                $customer->save();

                return redirect()->back()->with('success', 'User created but this company is not registered');
            }
        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Get customer view with data
     * @param int $id
     * @return object
     */
    public function editCustomerView(int $id): object
    {
        if (isset($id)) {

            $getCustomer = Customer::where('id', $id)->get();

            foreach ($getCustomer as $customer) {
                $companyId = $customer->company_id;
            }
            if (isset($companyId)) {
                $getCompany = Company::where('id', $companyId)->get();

                foreach ($getCompany as $company) {
                    $companyName = $company->company_name;
                }
            } else {
                $companyName = "This customer is not a member of the company";
            }

            return view('customers/edit', [
                'customers' => $getCustomer,
                'company_name' => $companyName
            ]);
        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Edit Customer method
     * @param CustomerRequest $request
     * @return object
     */
    public function editCustomer(CustomerRequest $request): object
    {
        if (isset($request->name) && isset($request->id) && isset($request->company)) {


            $getCompany = Company::where('company_name', $request->company)->get();

            foreach ($getCompany as $company) {
                if (isset($company)) {
                    $companyId = $company->id;
                }
            }
            if (isset($companyId)) {
                $customer = Customer::where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'company_id' => $companyId
                    ]);
                return redirect()->back()->with('success', 'User edited');
            } else {
                return redirect()->back()->withErrors(['error' => 'This company does not exist']);
            }

        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Get view for delete customer
     * @param int $id
     * @return object
     */
    public function deleteCustomerView(int $id): object
    {
        if (isset($id)) {

            return view('customers/delete', [
                'id' => $id
            ]);
        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Delete Customer
     * @param Request $request
     * @return object
     */
    public function deleteCustomer(Request $request): object
    {
        if (isset($request->delete)) {

            $delete = Customer::where('id', $request->delete)->delete();

            return redirect()->route('customers_view')->with('success', 'User deleted');
        }

        return redirect()->route('customers_view');
    }

    /**
     * Get customer list by company id
     * @param int $companyId
     * @param int|null $paginate
     * @return object
     */
    public function getCustomersForApi(int $companyId, int $paginate = null): object
    {
        if (isset($companyId)) {

            if (!isset($paginate)) {

                return Customer::where('company_id', $companyId)->get();
            } else {

                return Customer::where('company_id', $companyId)->orderBy('id', 'asc')->paginate($paginate);
            }
        }
    }

}
