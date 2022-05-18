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
                User::USER_IN_ACTIVE
            ])->default(User::USER_IN_ACTIVE);
            $table->enum('user_type',
            [
                User::ROLE_CUSTOMER, // Model
                User::ROLE_SELLER, 
                User::ROLE_PROFESSIONAL
            ])->default(User::ROLE_CUSTOMER);
            $table->string('introduction', 150)->nullable();
            $table->string('background', 200)->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('price_range')->nullable();
            $table->date('joined')->nullable();
            $table->bigInteger('license_number')->nullable();
            $table->string('business_name')->nullable();
            $table->string('specialization')->nullable();
            $table->string('areas_served')->nullable();
            $table->string('occupation')->nullable(); // a new table to be created
            $table->string('experiences')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->enum('pre_approved', 
            [
                User::LENDER_APPROVED,
                User::LENDER_UNAPPROVED
            ])->default(User::LENDER_APPROVED);
            $table->string('property_type');
            $table->enum('working_with_agent', 
            [
                User::WORKING_WITH_AGENT,
                User::NOT_WORKING_WITH_AGENT,
            ])->default(User::WORKING_WITH_AGENT);
            $table->string('name_of_agent')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->bigInteger('flags', 0)->default();
            $table->rememberToken(); // used for reset password
            $table->timestamps();
        });

        // For General Users
        Schema::create('subscribers', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('industry');
            $table->string('occupation'); // create occupation table
            $table->text('comments');
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');

        });

        // Customer or Seller can review to agent
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('communication')->nullable();
            $table->integer('reliability')->nullable();
            $table->integer('quality_of_service')->nullable();
            $table->integer('negotiation_knowledge')->nullable();
            $table->text('review');
            $table->integer('number_of_reviews');
            $table->string('review_to'); // Name
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });

        Schema::create('messages', function (Blueprint $table){
            $table->id();
            $table->text('message');
            $table->text('document');
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

        Schema::create('listings', function (Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->enum('seeking_for', [
              User::HOUSE_FOR_RENT,
              User::HOUSE_FOR_SELL,  
            ])->default(User::HOUSE_FOR_RENT);
            $table->integer('dedicated_parkings');
            $table->string('square_foot');
            $table->text('description');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->integer('post_code');
            $table->string('location');
            $table->enum('listing_status', 
            [
                User::HOUSE_SELL_STATUS,
                User::HOUSE_SOLD_STATUS,
            ])->default(User::HOUSE_SELL_STATUS);
            $table->enum('delete_status', 
            [
                User::DELETED_STATUS,
                User::NOT_DELETED_STATUS,
            ])->default(User::DELETED_STATUS);
            $table->integer('insights'); // 5 view(s)
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->constrained('users');
        });

        Schema::create('listing_images', function (Blueprint $table){
            $table->id();
            $table->string('path');
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('listing_id')->references('id')->on('listings');
        });
        
        Schema::create('favorites', function (Blueprint $table){
            $table->id();
            $table->enum('status', 
            [
                User::ADDED_TO_FAVORITE,
                User::NOT_ADDED_TO_FAVORITE,
            ])->default(User::NOT_ADDED_TO_FAVORITE);
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('listing_id')->references('id')->on('listings');

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });
        Schema::create('payments', function (Blueprint $table){
            $table->id();
            $table->bigInteger('card_number')->unique();
            $table->date('expiry_date');
            $table->integer('cvv');
            $table->enum('secured_by', 
            [
                User::VISA_CARD,
                User::MASTER_CARD,
                User::MAESTRO_CARD,
                User::AMERICAN_EXPRESS_CARD,
            ]);
            $table->enum('status', 
            [
                User::PAYMENT_PENDING,
                User::PAYMENT_FAILED,
                User::PAYMENT_PAID,
            ]);
            $table->string('amount');
            $table->bigInteger('flags', 0)->default();
            $table->timestamps();

            // Foreign key
            $table->foreignId('user_id')->references('id')->on('users');
        });
        
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
      
        // Schema::table('contact_us', function (Blueprint $table) {
        //     $table->dropForeign('contact_us_user_id_foreign');
        // });
        Schema::dropIfExists('users');
    }
};
