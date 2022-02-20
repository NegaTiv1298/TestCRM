<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;

/**
 * Class CompanyController
 * @package App\Http\Controllers
 */
class CompanyController extends Controller
{
    /**
     * Get companies list
     * @return object
     */
    public function getCompanies(): object
    {
        $company = new Company();

        $companiesList = $company->orderBy('id', 'asc')->paginate(50);

        return view('companies/view', [
            'companies' => $companiesList
        ]);
    }

    /**
     * Get view for crete company
     * @return object
     */
    public function createCompanyView(): object
    {
        return view('companies/create');
    }


    /**
     * Create new company
     * @param CompanyRequest $request
     * @return object
     */
    public function createCompany(CompanyRequest $request): object
    {
        if (!empty($request->company_name)) {

            $checkCompany = Company::where('company_name', $request->company_name)->get();

            if (!isset($checkCompany[0]->company_name)) {

                $company = new Company([
                    'company_name' => $request->company_name
                ]);

                $company->save();

                return redirect()->back()->with('success', 'The company has been created');
            } else {
                return redirect()->back()->withErrors(['msg' => 'This company already exists']);
            }
        }
        return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
    }

    /**
     * Get companies view with data
     * @param int $id
     * @return object
     */
    public function editCompanyView(int $id): object
    {
        if (isset($id)) {

            $getCompany = Company::where('id', $id)->get();

            return view('companies/edit', [
                'companies' => $getCompany,
            ]);
        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Edit companies method
     * @param CompanyRequest $request
     * @return object
     */
    public function editCompany(CompanyRequest $request): object
    {
        if (isset($request->id) && isset($request->company_name)) {

            $checkCompany = Company::where('company_name', $request->company_name)->get();

            foreach ($checkCompany as $check) {

                if (isset($check->company_name)) {
                    return redirect()->back()->withErrors(['msg' => 'This company already exists']);
                }
            }
            $company = Company::where('id', $request->id)
                ->update([
                    'company_name' => $request->company_name
                ]);

            return redirect()->back()->with('success', 'The company has been edited');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Get company view for delete
     * @param int $id
     * @return object
     */
    public function deleteCompanyView(int $id): object
    {
        if (isset($id)) {

            return view('companies/delete', [
                'id' => $id
            ]);
        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid Request']);
        }
    }

    /**
     * Delete company
     * @param Request $request
     * @return object
     */
    public function deleteCompany(Request $request): object
    {
        if (isset($request->delete)) {

            $delete = Company::where('id', $request->delete)->delete();

            return redirect()->route('companies_view')->with('success', 'The company has been deleted');
        }

        return redirect()->route('companies_view');
    }


    /**
     * Get companies list
     * @param int|null $paginate
     * @return object
     */
    public function getCompaniesForApi(int $paginate = null) : object
    {
        if (!isset($paginate)) {
            return Company::all();
        }

        return Company::orderBy('id', 'asc')->paginate($paginate);
    }

    /**
     * Get customers company by customer ID
     * @param int $id
     * @return array
     */
    public function getCompanyByCustomerIdForApi(int $id) : array
    {
        $arrCompaniers = [];

        if (isset($id)) {
            $customer = Customer::where('id', $id)->get();
            foreach ($customer as $value) {
                if (isset($value->company_id)) {

                    $company = Company::where('id', $value->company_id)->get();

                    foreach ($company as $companyValue) {
                        if (isset($companyValue->company_name)) {

                            $arrCompaniers[] = ["Customer id - $id" => $companyValue->company_name];
                        }
                    }
                }
            }
        }
        return $arrCompaniers;
    }
}
