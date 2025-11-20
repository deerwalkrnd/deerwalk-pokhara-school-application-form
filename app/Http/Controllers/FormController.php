<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyRequest;
use App\Mail\AdminPdfMail;
use App\Mail\Confirm;
use App\Models\Application;
use App\Models\ApplicationData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ApplyRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $application = Application::create();
            $data['application_id'] = $application->id;

            $imageName = $application->id . "." . $data["image"]->getClientOriginalExtension();
            $path = $data['image']->storeAs('images/applicants/', $imageName, 'public');

            $data['image'] = $imageName;
            $applicationData = ApplicationData::create($data);
            FormController::sendEmail($data['email_parent'], $application->id, $data['email_guardian']);
            DB::commit();

            return redirect(route('form.success'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(["error" => "Failed to submit form"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */


    public function success()
    {
        return view("thankyou");
    }

    public function sendEmail(string $email, int $appId, string $guardianEmail = null)
    {
        try {

            $toEmail = "tej.kafle@pokhara.deerwalk.edu.np";
            $ccEmail = [];

            // $toEmail = "suyash.adhikari@deerwalk.edu.np";
            // $ccEmail = "srijan.dahal@deerwalk.edu.np";


            $pdfPath = PdfController::generatePdf($appId);
            $application = Application::findOrFail($appId);


            if($guardianEmail){
                Mail::to($email)->cc($guardianEmail)->send(new Confirm());
            }else{
                Mail::to($email)->send(new Confirm());
            }

            $mailCheck = Mail::to($toEmail)->cc($ccEmail)->send(new AdminPdfMail($pdfPath));
            if($mailCheck){
                $application->is_email_sent = true;
            }

            $application->save();

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An unexpected error occured. Please try again later.']);
        }
    }

    public function sendTestMail(){
        //this is a test function for calling the mail function, just uncomment the route for this function to enable this 
        $email='rahul.shah@deerwalk.edu.np';
        $this->sendEmail( $email, 5,null );
        return redirect(route('form.success'));
    }
    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
