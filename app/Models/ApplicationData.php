<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ApplicationData extends Model
{
    use HasFactory;

    protected $table = "application_data";

    protected $fillable = [
        "first_name",
        "middle_name",
        "last_name",
        "image",
        "province",
        "district",
        "town",
        "emis_no",
        "passed_grade",
        "grade_applied",
        "gpa",
        "current_school",
        "home_language",
        "physical_condition",
        "allergy",
        "special_assistance",
        "parent_name",
        "province_parent",
        "district_parent",
        "town_parent",
        "contact_parent",
        "email_parent",
        "academic_qualification_parent",
        "profession_parent",
        "guardian_name",
        "province_guardian",
        "district_guardian",
        "town_guardian",
        "contact_guardian",
        "email_guardian",
        "academic_qualification_guardian",
        "profession_guardian",
        "application_id"
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class, "application_id");
    }

}
