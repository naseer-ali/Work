<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Model
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('confirm_password');
            $table->string('phone');
            $table->string('post_code');
            $table->string('country');
            $table->enum('status', 
            [
                User::USER_ACTIVE,
                User::USER_IN_ACTIVE,
            ])->default(User::USER_IN_ACTIVE);
            $table->enum('user_type',
            [
                User::ROLE_CUSTOMER, // Model
                User::ROLE_SELLER, 
                User::ROLE_PROFESSIONAL
            ])->default(User::ROLE_CUSTOMER);
            $table->string('introduction', 150);
            $table->string('background', 200);
            $table->string('path');
            $table->string('budget_of_property');
            $table->enum('pre_approved', 
            [
                User::LENDER_APPROVED,
                User::LENDER_UNAPPROVED,
            ])->default(User::LENDER_APPROVED);
            $table->string('property_type');
            $table->enum('working_with_agent', 
            [
                User::WORKING_WITH_AGENT,
                User::NOT_WORKING_WITH_AGENT,
            ])->default(User::WORKING_WITH_AGENT);
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->bigInteger('flags', 0)->default();
            $table->rememberToken(); // used for reset password
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('review');
            $table->integer('rating');
            $table->integer('communication')->nullable();
            $table->integer('reliability')->nullable();
            $table->integer('quality_of_service')->nullable();
            $table->integer('negotiation_knowledge')->nullable();
            $table->integer('number_of_reviews');
            $table->string('review_from'); // Name
            $table->string('review_to'); // Name
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });

        Schema::create('messages', function (Blueprint $table){
            $table->id();
            $table->text('message');
            $table->enum('seen_status', 
            [
                User::SEEN_STATUS,
                User::UN_SEEN_STATUS,
            ])->default(User::UN_SEEN_STATUS);
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();
            
            // Foreign key
            $table->foreignId('to_id')->references('id')->on('users');

            // Foreign key
            $table->foreignId('from_id')->references('id')->on('users');
        });

        // Schema::create('review_for_agents', function (Blueprint $table){
        //     $table->id();
        //     $table->integer('communication')->nullable();
        //     $table->integer('reliability')->nullable();
        //     $table->integer('quality_of_service')->nullable();
        //     $table->integer('negotiation_knowledge')->nullable();
        //     $table->text('comment');
        //     $table->integer('number_of_reviews');
        //     $table->bigInteger('flags', 0)->default();
        //     $table->timestamps();

        //     // Foreign key
        //     $table->foreignId('user_id')->references('id')->on('users');
        // });
        
        Schema::create('comments', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('comment');
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });

        Schema::create('concerns', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('concerns');  
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });

        Schema::create('contact_us', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });

        Schema::create('feedbacks', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('feedback');
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
