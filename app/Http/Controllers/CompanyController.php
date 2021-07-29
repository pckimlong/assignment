<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLogin;
use App\Models\Industry;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
    }
    
    public function overview()
    {
        return view('company.company-overview');
    }

    //! Upload job----------------------------------------------------
    public function uploadView()
    {
        return view('company.upload-job');
    }

    
    //! Company information----------------------------------------------------
    public function infoView()
    {
        $company = Company::find(auth()->user()->id);
        $industries = Industry::orderBy('name')->get();
        $provinces = Province::orderBy('province')->get();
        
        return view('company.company-info', [
                'company'=> $company,
                'industries' => $industries,
                'provinces' => $provinces,
            ]);
    }
    public function update(Request $request)
    {
        $this->validateCompanyUpdate($request);

        $company = Company::find(auth()->user()->id);
        if ($this->companyUpdate($company, $request)) {
            Alert::toast('Company updated!', 'success');
            return redirect()->route('company.info');
        }
        Alert::toast('Failed!', 'error');
        return redirect()->route('company.info');
    }
    protected function validateCompanyUpdate(Request $request)
    {
        return $request->validate([
            'company_name' => 'required|min:5',
            'description' => 'required|min:5',
            'logo' => 'image|max:2999',
            'email' => 'required|email',
            'contact_person_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|numeric',
        ]);
    }
    protected function companyUpdate(Company $company, Request $request)
    {
        $company->company_name = $request->company_name;
        $company->industry_id = $request->industry_id;
        $company->website = $request->website;
        $company->email = $request->email;
        $company->contact_person_name = $request->contact_person_name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->province_id = $request->province_id;
        $company->description = $request->description; 

        //logo should exist but still checking for the name
        if ($request->hasFile('logo')) {
            $fileNameToStore = $this->getFileName($request->file('logo'));
            $logoPath = $request->file('logo')->storeAs('public/companies/logos', $fileNameToStore);
            if ($company->logo) {
                Storage::delete('public/companies/logos/' . basename($company->logo));
            }
            $company->logo = 'storage/companies/logos/' . $fileNameToStore;

            
        }

        if ($company->save()) {
            return true;
        }
        return false;
    }
    protected function getFileName($file)
    {
        $fileName = $file->getClientOriginalName();
        $actualFileName = pathinfo($fileName, PATHINFO_FILENAME);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        return $actualFileName . time() . '.' . $fileExtension;
    }


    //! Change password --------------------------------------------------------
    public function changePasswordView(){
        return view('company.company-change-password');
    }

    public function changePassword(Request $request)
    {
        if (!auth()->user()) {
            Alert::toast('Not authenticated!', 'success');
            return redirect()->back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);

        $authUser = CompanyLogin::find(auth()->user()->id);
        $currentP = $request->current_password;
        $newP = $request->new_password;
        $confirmP = $request->confirm_password;

        if (Hash::check($currentP, $authUser->password)) {
            if (Str::of($newP)->exactly($confirmP)) {
                $authUser->password = Hash::make($newP);
                if ($authUser->save()) {
                    Alert::toast('Password Changed!', 'success');
                } else {
                    Alert::toast('Something went wrong!', 'warning');
                }
            } else {
                Alert::toast('Comfirm password do not match!', 'info');
            }
        } else {
            Alert::toast('Incorrect current Password!', 'info');
        }
        return redirect()->back();
    }

}
