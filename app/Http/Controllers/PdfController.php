<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use setasign\Fpdi\Fpdi;

use function PHPUnit\Framework\fileExists;

class PdfController extends Controller
{
    public static function generatePdf(int $appId)
    {
        try {
            $application = Application::findOrFail($appId);
            $data = ApplicationData::where('application_id', $appId)->firstOrFail();
            $imagePath = storage_path("app/public/images/applicants/".$data->image);
            $pdf = new Fpdi();
            $pdf->AddPage();

            $path = public_path('assets/pdf/DPS_form.pdf');

            $pdf->setSourceFile($path);

            $tplId = $pdf->importPage(1);
            $pdf->useTemplate($tplId, 0, 0, null, null, true);

            $pdf->setFont('Times', '', '16');

            $pdf->SetXY(25, 83.6);
            $pdf->Write(0.1, "First Name: ". $data->first_name);

            $pdf->SetXY(25, 91.19);
            $pdf->Write(0.1, "Middle Name: ". $data->middle_name);

            $pdf->SetXY(25, 98.81);
            $pdf->Write(0.1, "Last Name: " . $data->last_name);

            $pdf->SetXY(25, 113.5);
            $pdf->Write(0.1, "Province: ".$data->province);

            $pdf->SetXY(25, 121.5);
            $pdf->Write(0.1, "District: ".$data->district);

            $pdf->SetXY(25, 128.2);
            $pdf->Write(0.1, "Town: " . $data->town);

            $pdf->SetXY(25,143);
            $pdf->Write(0.1, "Current School: ".$data->current_school);

            $pdf->SetXY(25,150.7);
            $pdf->Write(0.1, "Home Language: ".$data->home_language);

            $pdf->SetXY(25,158.2);
            $pdf->Write(0.1, "Passed Grade: ".$data->passed_grade);

            $pdf->SetXY(25,165.86);
            $pdf->Write(0.1, "Grade Applied: ".$data->grade_applied);

            $pdf->SetXY(25,173.4);
            $pdf->Write(0.1, "Grade Point Average: ".$data->gpa);

            $pdf->SetXY(25,181.4);
            $pdf->Write(0.1, "EMIS No.: ".$data->emis_no);

            $pdf->SetXY(25,192.53);
            $pdf->Write(0.1,  $data->physicalcondition == 1 ? "Has Some Physical Condition: YES" : "Has Some Physical Condition: NO");

            $pdf->SetXY(25,200.41);
            $pdf->Write(0.1, $data->allergy == 1 ? "Has Allergy: YES" : "Has Allergy: NO");

            $pdf->SetXY(25,207.26);
            $pdf->Write(0.1,  $data->special_assistance == 1 ? "Needs Special Assistance: YES" : "Needs Special Assistance: NO");

            $pdf->Image($imagePath, 162, 31, 40, 40);

            $tplId = $pdf->importPage(2);
            $pdf->AddPage();
            $pdf->useTemplate($tplId, 0, 0, null, null, true);

            $pdf->SetXY(25, 39.6);
            $pdf->Write(0.1, "Name: ". $data->parent_name);

            $pdf->SetXY(25, 46.3);
            $pdf->Write(0.1, "Province: ". $data-> province_parent);

            $pdf->SetXY(25, 53.5);
            $pdf->Write(0.1, "District: ". $data-> district_parent);

            $pdf->SetXY(25, 61.72);
            $pdf->Write(0.1, "Town: ". $data-> town_parent);

            $pdf->SetXY(25,76.45);
            $pdf->Write(0.1, "Contact No.: ". $data->contact_parent);

            $pdf->SetXY(25,83.90);
            $pdf->Write(0.1, "Email: ". $data->email_parent);

            $pdf->SetXY(25,91.19);
            $pdf->Write(0.1, "Academic Qualifications: ". $data->academic_qualification_parent);

            $pdf->SetXY(25,98.55);
            $pdf->Write(0.1, "Profession: ". $data->profession_parent);

            $pdf->SetXY(25, 128.35);
            $pdf->Write(0.1, "Name: ". $data->guardian_name);

            $pdf->SetXY(25, 135.64);
            $pdf->Write(0.1, "Province: ". $data-> province_guardian);

            $pdf->SetXY(25, 143);
            $pdf->Write(0.1, "District: ". $data-> district_guardian);

            $pdf->SetXY(25, 150.2);
            $pdf->Write(0.1, "Town: ". $data-> town_guardian);

            $pdf->SetXY(25,165.3);
            $pdf->Write(0.1, "Contact No.: ". $data->contact_guardian);

            $pdf->SetXY(25,173);
            $pdf->Write(0.1, "Email: ". $data->email_guardian);

            $pdf->SetXY(25,180.3);
            $pdf->Write(0.1, "Academic Qualifications: ". $data->academic_qualification_guardian);

            $pdf->SetXY(25,188.2);
            $pdf->Write(0.1, "Profession: ". $data->profession_guardian);

            $outputPath = storage_path("app/public/pdf/");
            $outputFileName = $data->first_name."_".$data->last_name."_".$application->id.".pdf";
            $outputFilePath = $outputPath.$outputFileName;
            
            $pdf->Output("F", $outputFilePath);

            $application->update([
                'pdf' => $outputFileName,
                'is_pdf_generated' => 1,
            ]);

            return($outputFilePath);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Unable to generate pdf!']);
        }
    }
}
