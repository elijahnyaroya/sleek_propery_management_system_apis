<?php

namespace App\Http\Controllers;

use App\Models\properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{

    public function allProperties(){
        return properties::all();
    }
    //
    /**
     * This creates and saves new property.
     */
    public function createNewProperty(Request $request){
        //Validating property details
        $validate = Validator::make($request->all(), [
            "property_name"    => "required|string|max:255",               // Property name is required, should be a string, and limited to 255 characters
            "address"           => "required|string|max:255",               // Address is required and should be a string
            "state"             => "required|string|max:100",               // State is required and should be a string
            "country"           => "required|string|max:100",               // Country is required and should be a string
            "price"             => "required|numeric|min:0",                // Price is required, must be numeric, and greater than or equal to 0
            "property_type"     => "required|in:Apartment,House,Condo,Commercial", // Property type is required, must be one of the listed options
            "bedrooms"          => "required|integer|min:1",                // Bedrooms must be an integer greater than or equal to 1
            "bathrooms"         => "required|integer|min:1",                // Bathrooms must be an integer greater than or equal to 1
            "year_built"        => "required|integer|digits:4|between:1900,2099",  // Year built should be a valid 4-digit year between 1900 and 2099
            "status"            => "required|in:Available,Sold,Rented,Under Contract", // Status must be one of the defined options
            "listing_type"      => "required|in:Sale,Rent,Lease",           // Listing type must be one of the defined options
            "image"             => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048", // Image must be a valid file, and limited to certain types and size (2MB max)
            "description"       => "nullable|string|min:10|max:1000",       // Description is optional but if provided, must be a string with 10 to 1000 characters
        ]);


        if ($validate->passes()){

            $property_name  = $request->get("property_name");
            $address  = $request->get("address");
            $state  = $request->get("state");
            $country  = $request->get("country");
            $price  = $request->get("price");
            $property_type  = $request->get("property_type");
            $bedrooms  = $request->get("bedrooms");
            $bathrooms  = $request->get("bathrooms");
            $year_built  = $request->get("year_built");
            $status  = $request->get("status");
            $listing_type  = $request->get("listing_type");
            $description  = $request->get("description");

            //
            $image  = $request->file("image");

            $fileLocation = public_path("/assets/properties/");//specifying the folder where the image will be saved on
            $imageName  = $image->getClientOriginalName(); // getting image file name
            $imagePath  = "/assets/properties/";//this is the folder path

            if (databaseTablesController::saveProperty($property_name, $address, $state, $country, $price, $property_type, $bedrooms, $bathrooms, $year_built, $status, $listing_type, $description,$imageName,$imagePath)){
                //when the above is saved in the database, we save the image in the folder
                $image->move($fileLocation,$imageName);
                return response()->json([
                    "success"=>true,
                    "response"=>"Property added successfully."
                ]);
            }else{
                return response()->json([
                    "success"=>false,
                    "response"=>"Error adding property details."
                ]);
            }

        }else{
            return response()->json([
                "success"=>false,
                "response"=>$validate->messages()
            ]);
        }
    }


    //Deleting property from property table by id
    public function destroyProperty($propertyId){
       if (databaseTablesController::deleteProperty($propertyId)){
           return response()->json([
               "success"=>true,
               "response"=>"Property deleted successfully",
           ]);
       }else{
           return response()->json([
               "success"=>false,
               "response"=>"Error deleting property"
           ]);
       }
    }



    /**
     * This creates and saves new property.
     */
    public function updateProperty(Request $request,$propertyId){

        //Validating property details
        $validate = Validator::make($request->all(), [
            "property_name"    => "required|string|max:255",               // Property name is required, should be a string, and limited to 255 characters
            "address"           => "required|string|max:255",               // Address is required and should be a string
            "state"             => "required|string|max:100",               // State is required and should be a string
            "country"           => "required|string|max:100",               // Country is required and should be a string
            "price"             => "required|numeric|min:0",                // Price is required, must be numeric, and greater than or equal to 0
            "property_type"     => "required|in:Apartment,House,Condo,Commercial", // Property type is required, must be one of the listed options
            "bedrooms"          => "required|integer|min:1",                // Bedrooms must be an integer greater than or equal to 1
            "bathrooms"         => "required|integer|min:1",                // Bathrooms must be an integer greater than or equal to 1
            "year_built"        => "required|integer|digits:4|between:1900,2099",  // Year built should be a valid 4-digit year between 1900 and 2099
            "status"            => "required|in:Available,Sold,Rented,Under Contract", // Status must be one of the defined options
            "listing_type"      => "required|in:Sale,Rent,Lease",           // Listing type must be one of the defined options
            "description"       => "nullable|string|min:10|max:1000",       // Description is optional but if provided, must be a string with 10 to 1000 characters
        ]);


        if ($validate->passes()){

            $property_name  = $request->get("property_name");
            $address  = $request->get("address");
            $state  = $request->get("state");
            $country  = $request->get("country");
            $price  = $request->get("price");
            $property_type  = $request->get("property_type");
            $bedrooms  = $request->get("bedrooms");
            $bathrooms  = $request->get("bathrooms");
            $year_built  = $request->get("year_built");
            $status  = $request->get("status");
            $listing_type  = $request->get("listing_type");
            $description  = $request->get("description");

            //


            if (databaseTablesController::updateProperty($propertyId,$property_name, $address, $state, $country, $price, $property_type, $bedrooms, $bathrooms, $year_built, $status, $listing_type, $description)){
                return response()->json([
                    "success"=>true,
                    "response"=>"Property updated successfully."
                ]);
            }else{
                return response()->json([
                    "success"=>false,
                    "response"=>"Error updating property details."
                ]);
            }



        }else{
            return response()->json([
                "success"=>false,
                "response"=>$validate->messages()
            ]);
        }
    }

}
