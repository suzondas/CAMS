<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsSscInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_ssc_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_bn')->nullable();
            $table->string('board_name');
            $table->string('roll');
            $table->string('registration');
            $table->decimal('gpa', 3, 2);
            $table->enum('ssc_group', ['Science', 'Business Studies', 'Humanities']);
            $table->enum('hsc_group', ['Science', 'Business Studies', 'Humanities']);
            $table->year('passing_year');
            $table->string('session');
            $table->string('esif_serial')->nullable();
            $table->string('quota_name')->nullable();
            $table->char('mobile', 11);
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->integer('registered')->nullable();
            $table->timestamps();  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_ssc_infos');
    }
}
