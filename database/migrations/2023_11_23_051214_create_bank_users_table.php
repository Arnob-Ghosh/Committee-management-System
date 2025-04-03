<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_users', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->integer('contact')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('nid')->unique();
            $table->string('image')->nullable();
            $table->string('signature')->nullable();
            $table->string('designation_id')->nullable();
            $table->string('comitee_designation')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('blood_group')->nullable();
            $table->boolean('status')->default(2)->comment('1=Active, 0=Inactive, 2=Pending');
            $table->string('district')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('village_id')->nullable();
            $table->string('post_office')->nullable();
            $table->string('religion')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('section')->nullable();
            $table->string('facebook_id')->nullable();
            $table->text('present_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_users');
    }
}
