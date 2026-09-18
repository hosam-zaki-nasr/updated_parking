<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Garage;
use App\Models\Parking;
use App\Models\User;
use Customer\Http\Resources\Car\CarMinifiedResource;
use Dashboard\Foundations\Report\CarReportSearchCollection;
use Dashboard\Foundations\Report\ContactReportSearchCollection;
use Dashboard\Foundations\Report\CustomerReportSearchCollection;
use Dashboard\Foundations\Report\DriverReportSearchCollection;
use Dashboard\Http\Resources\Report\Parking\ParkingResource;
use Dashboard\Foundations\Report\GarageReportSearchCollection;
use Dashboard\Foundations\Report\ParkingReportSearchCollection;
use Dashboard\Foundations\Report\SubscriptionSearchCollection;
use Dashboard\Http\Resources\Contact\ContactMinifiedResource;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Dashboard\Http\Resources\Report\Garage\GarageMinifiedResource;
use Dashboard\Http\Resources\Subscription\SubscriptionMinifiedResource;
use Dashboard\Http\Resources\ValetDriver\ValetDriverMinifiedResource;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function garageReport(Request $request)
    {
        $garages = GarageReportSearchCollection::searchAllGarageReports(
            $request->get('garage_id') ? $request->get('garage_id') : -1,
            $request->get('type_id') ? $request->get('type_id') : -1,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('starts_at') ? $request->get('starts_at') : -1,
            $request->get('ends_at') ? $request->get('ends_at') : -1,
            $request->get('period') ? $request->get('period') : -1,

            $request->get('car_type_id') ? $request->get('car_type_id') : -1,
            $request->get('car_number') ? $request->get('car_number') : -1,
            $request->get('customer_name') ? $request->get('customer_name') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,

            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(GarageMinifiedResource::collection($garages));
    }

    public function parkingReport(Request $request)
    {
        $garages = ParkingReportSearchCollection::searchAllParkingReports(
            $request->get('garage_id') ? $request->get('garage_id') : -1,
            $request->get('type_id') ? $request->get('type_id') : -1,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('starts_at') ? $request->get('starts_at') : -1,
            $request->get('ends_at') ? $request->get('ends_at') : -1,
            $request->get('period') ? $request->get('period') : -1,

            $request->get('car_type_id') ? $request->get('car_type_id') : -1,
            $request->get('car_number') ? $request->get('car_number') : -1,
            $request->get('customer_name') ? $request->get('customer_name') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,

            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(ParkingResource::collection($garages));
    }

    public function customerReport(Request $request)
    {
        $customers = CustomerReportSearchCollection::searchAllCustomerReports(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('country_id') ? $request->get('country_id') : -1,
            $request->get('governorate_id') ? $request->get('governorate_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,

            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CustomerMinifiedResource::collection($customers));
    }

    public function contactReport(Request $request)
    {
        $contacts = ContactReportSearchCollection::searchAllContactReports(
            $request->get('customer_id') ? $request->get('customer_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('country_id') ? $request->get('country_id') : -1,
            $request->get('governorate_id') ? $request->get('governorate_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,

            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(ContactMinifiedResource::collection($contacts));
    }

    public function carReport(Request $request)
    {
        $cars = CarReportSearchCollection::searchAllCarReports(
            $request->get('customer_id') ? $request->get('customer_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('full_number') ? $request->get('full_number') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('car_color_id') ? $request->get('car_color_id') : -1,
            $request->get('car_type_id') ? $request->get('car_type_id') : -1,

            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CarMinifiedResource::collection($cars));
    }

    public function driverReport(Request $request)
    {
        $drivers = DriverReportSearchCollection::searchAllDriverReports(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('garage_id') ? $request->get('garage_id') : -1,
            $request->get('country_id') ? $request->get('country_id') : -1,
            $request->get('governorate_id') ? $request->get('governorate_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,

            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(ValetDriverMinifiedResource::collection($drivers));
    }

    public function subscriptionReport(Request $request)
    {
        $drivers = SubscriptionSearchCollection::searchSubscriptionReports(
            $request->get('user_id') ? $request->get('user_id') : -1,
            $request->get('garage_id') ? $request->get('garage_id') : -1,
            $request->get('starts_at') ? $request->get('starts_at') : -1,
            $request->get('ends_at') ? $request->get('ends_at') : -1,
            $request->get('is_active') !== null ? $request->get('is_active') : -1,
            $request->get('deleted_at') !== null ? $request->get('deleted_at') : -1,

            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(SubscriptionMinifiedResource::collection($drivers));
    }

    public function dashboardCounter(Request $request)
    {
        $customer_type_id = AccountTypeCollection::customer()->id;
        $contact_type_id = AccountTypeCollection::contact()->id;
        $driver_type_id = AccountTypeCollection::driver()->id;

        $data['garage_count'] = Garage::where('deleted_at', null)->count();
        $data['parking_count'] = Parking::where('deleted_at', null)->count();
        $data['customer_count'] = User::whereNull('deleted_at')->where('account_type_id', $customer_type_id)->count();
        $data['contact_count'] = User::whereNull('deleted_at')->where('account_type_id', $contact_type_id)->count();
        $data['driver_count'] = User::whereNull('deleted_at')->where('account_type_id', $driver_type_id)->count();
        $data['car_count'] = Car::whereNull('deleted_at')->count();


        return response()->success(
            trans('general.retrieved'),
            $data,
            StatusCode::OK
        );
    }
}
