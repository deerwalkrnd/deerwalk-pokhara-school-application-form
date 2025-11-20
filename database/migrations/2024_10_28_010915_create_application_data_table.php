<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('application_data', function (Blueprint $table) {
            $table->id();

            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("last_name");

            $table->string("image");

            $table->string("province");
            $table->string("district");
            $table->string("town");


            $table->string("emis_no")->nullable();

            $table->string("passed_grade");
            $table->string("grade_applied");
            $table->string("gpa");
            $table->string("current_school");
            $table->string("home_language")->nullable();

            $table->boolean("physical_condition")->default("0");
            $table->boolean("allergy")->default('0');
            $table->boolean("special_assistance")->default('0');


            $table->string("parent_name");

            $table->string("province_parent");
            $table->string("district_parent");
            $table->string("town_parent");


            $table->string("contact_parent");


            $table->string("email_parent");
            $table->string("academic_qualification_parent")->nullable();
            $table->string("profession_parent")->nullable();

            $table->string("guardian_name")->nullable();
            $table->string("province_guardian")->nullable();
            $table->string("district_guardian")->nullable();
            $table->string("town_guardian")->nullable();

            $table->string("contact_guardian")->nullable();

            $table->string("email_guardian")->nullable();
            $table->string("academic_qualification_guardian")->nullable();
            $table->string("profession_guardian")->nullable();



            $table->unsignedBigInteger("application_id");
            $table->foreign("application_id")->references("id")->on("applications")->onUpdate('cascade')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
