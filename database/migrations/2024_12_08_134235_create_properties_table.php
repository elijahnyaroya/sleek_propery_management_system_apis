<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string("property_name",100)->comment("This is the name of the propery (e.g., Skyvue Solair Apartments)");
            $table->string("address",100)->comment("This is full address of the property (including street, city, state, zip code)");
            $table->string("state",100)->comment("This is the location where the property is situated");
            $table->string("country",100)->comment("This is the country where the property is located at (e.g., Dubai");
            $table->decimal("price",10,2)->comment("This is the price of the property (e.g.,AED 1.15M)");
            $table->enum("property_type", ['Apartment', 'House', 'Commercial'])->comment("This is defines the type of the property (e.g., Apartment,House,Commercial) ");
            $table->integer("bedrooms")->comment("This specifies the number of bedroom the property has ");
            $table->integer("bathrooms")->comment("This specifies the number of number of bathrooms in the property.");
            $table->year("year_built")->comment("This specifies the they the property was built (e.g., 2024).");
            $table->enum("status",['Available', 'Sold', 'Rented'])->comment("This specifies the the property status (e.g.,available,sold,rented).");
            $table->enum("listing_type", ['Sale', 'Rent', 'Lease'])->comment("This specifies the type of listing ('Sale', 'Rent', 'Lease').");
            $table->string("image_path",200)->comment("This is the image location folder path (e.g., /assets/propertyimages/");
            $table->string("image_name",200)->comment("This is the image name including extension (e.g., property_001.png");
            $table->text("description")->comment("This is description of the property.");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
