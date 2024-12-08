<?php

namespace App\Http\Controllers;

use App\Models\properties;
use Illuminate\Http\Request;

class databaseTablesController extends Controller
{
    // This class cointains function that is intended to create, update and delete property details in the database
    static function saveProperty(
        $property_name, $address, $state, $country, $price, $property_type,
        $bedrooms, $bathrooms, $year_built, $status, $listing_type, $description,$imageName,$imagePath
    )
    {
        //Creating and saving an object of type property into the database table

         /*
          * Checking if property extist with the following details
          * property_name
          * state
          * country
          * price
          * year_built
          *
          * */
        $checkProperty = properties::where("property_name",$property_name)
            ->where("state",$state)
            ->where("country",$country)
            ->where("price",$price)
            ->where("year_built",$year_built)
            ->count();

        if ($checkProperty > 0){
            return false;
        }else{
            try {
                $property = new properties();
                $property->property_name = $property_name;
                $property->address = $address;
                $property->state = $state;
                $property->country = $country;
                $property->price = $price;
                $property->property_type = $property_type;
                $property->bedrooms = $bedrooms;
                $property->bathrooms = $bathrooms;
                $property->year_built = $year_built;
                $property->status = $status;
                $property->listing_type = $listing_type;
                $property->image_path = $imagePath;
                $property->image_name = $imageName;
                $property->description = $description;

                if ($property->save()) {
                    return true;
                } else {
                    return false;
                }
            }catch (\Exception $exception){
                return false;
            }
        }
    }
    //Updates property details by using ID
    static function updateProperty($propertyId,$property_name, $address, $state, $country, $price, $property_type, $bedrooms, $bathrooms, $year_built, $status, $listing_type, $description){
            try {
                $property = properties::where("id",$propertyId)->first(); // getting the property details
                $property->property_name = $property_name;
                $property->address = $address;
                $property->state = $state;
                $property->country = $country;
                $property->price = $price;
                $property->property_type = $property_type;
                $property->bedrooms = $bedrooms;
                $property->bathrooms = $bathrooms;
                $property->year_built = $year_built;
                $property->status = $status;
                $property->listing_type = $listing_type;
                $property->description = $description;

                if ($property->save()) {
                     return true;

                } else {
                    return false;
                }
            }catch (\Exception $exception){
                return false;
            }

    }

    //Delete property details from the database
    static function deleteProperty($propertyId){
        $results =  properties::where("id",$propertyId)->delete();
        if ($results){
            return true;
        }else{
            return false;
        }
    }
}
