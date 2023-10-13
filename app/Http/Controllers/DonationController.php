<?php

namespace App\Http\Controllers;

use App\Models\Donation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DonationController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // User is authenticated, retrieve the authenticated user
            $user = auth()->user();
            
            // Retrieve all donations
            $donations = Donation::orderBy('created_at', 'desc')->get();
    
            foreach ($donations as $donation) {
                // Check if the user has donated to this donation
                $donation->hasDonated = $user->donations->contains($donation->id);
    
                if ($donation->hasDonated) {
                    // Retrieve the donation history for this user in this donation
                    $donationHistory = $user->donations->where('id', $donation->id)->first()->pivot;
                    $donation->donationAmount = $donationHistory->amount;
                    $donation->donationTimestamp = $donationHistory->created_at;
                }
            }
    
            return view('donations.index', ['donations' => $donations]);
        } else {
            // User is not authenticated, handle this case (e.g., redirect to login)
            return redirect()->route('login')->with('error', 'You need to be logged in to view donations.');
        }
    }

public function create()
{
    // Display the create donation request form
    return view('donations.create');
    
}

public function store(Request $request)
{
    // Check if the user is authenticated
    if (auth()->check()) {
        // User is authenticated, proceed with creating the donation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'required|numeric',
        ]);

        $donation = new Donation();
        $donation->title = $validatedData['title'];
        $donation->description = $validatedData['description'];
        $donation->target_amount = $validatedData['target_amount'];
        $donation->amount = 0; // Set the 'amount' field to the default value
        $donation->user_id = auth()->user()->id; // Get the authenticated user's ID
        $donation->save();

        // Set the success flash message
        return redirect()->route('donations.index')->with('success', 'Donation successfully created!');
    } else {
        // User is not authenticated, handle this case (e.g., redirect to login)
        return redirect('/login')->with('error', 'You need to be logged in to create a donation.');
    }
}

public function show($id)
{
    // Check if the user is authenticated
    if (auth()->check()) {
        // User is authenticated, retrieve the authenticated user
        $user = auth()->user();

        // Fetch the specific donation by its ID
        $donation = Donation::find($id);

        if ($donation) {
            // Check if the user has donated to this donation
            $userHasDonated = $user->donations->contains($donation->id);

            // Retrieve the donation history for this user in this donation
            $userDonationHistory = $user->donations->where('id', $donation->id);

            return view('donations.show', [
                'donation' => $donation,
                'userHasDonated' => $userHasDonated,
                'userDonationHistory' => $userDonationHistory,
            ]);
        }
    }

    // User is not authenticated or the donation was not found, handle this case (e.g., redirect to login or 404 page)
    return redirect()->route('login')->with('error', 'You need to be logged in to view donations.');
}



public function edit($id)
{
    // Display the edit form for a specific donation request
    $donation = Donation::find($id);
    return view('donations.edit', ['donation' => $donation]);

}

public function update(Request $request, $id)
{
   // Validate and update an existing donation request
   $validatedData = $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'required|string',
    'target_amount' => 'required|numeric',
]);

    // Find the donation by its ID
    $donation = Donation::find($id);

    // Update the donation with the new data
    $donation->title = $validatedData['title'];
    $donation->description = $validatedData['description'];
    $donation->target_amount = $validatedData['target_amount'];
    $donation->save();

    // Set the success flash message
    return redirect()->route('donations.index');
}

public function complete($id)
{
    // Mark a donation request as complete
    // Find the donation by its ID
    $donation = Donation::find($id);

    // Update the 'is_complete' field in the database
    $donation->is_complete = true;
    $donation->save();

    // Redirect the user to a success page or the dashboard
    return redirect('donations.index')->with('success', 'Donation request marked as complete');
    // This method should update the 'is_complete' field in the database
}



public function participate(Request $request, $id)
{
    // Find the donation by its ID
    $donation = Donation::find($id);
    return view('donations.participate', ['donation' => $donation]);

    // Check if the user is authenticated
    if (auth()->check()) {
        // User is authenticated, proceed with participation logic
        $user = auth()->user();

        // You can access the donation amount entered by the user from the $request variable like this:
        $donationAmount = $request->input('donation_amount');

        // Check if the donation amount is valid (not null and greater than zero)
        if ($donationAmount !== null && $donationAmount > 0) {
            // Implement your participation logic here, such as updating the database to record the user's participation.
            // Attach the user to the donation with the specified amount
            $donation->participants()->attach($user->id, ['amount' => $donationAmount]);

            // After updating the database, you can redirect the user back to the show view with a success message
            return redirect()->route('donations.show', ['id' => $donation->id])->with('success', 'You have successfully donated ' . $donationAmount);
        } else {
            return redirect()->route('donations.show', ['id' => $donation->id])->with('error', 'Invalid donation amount.');
        }
    } else {
        // User is not authenticated, handle this case (e.g., redirect to login)
        return redirect()->route('login')->with('error', 'You need to be logged in to participate in a donation.');
    }
}


public function participateStore(Request $request, $id)
{
    // Find the donation by its ID
    $donation = Donation::find($id);

    // Check if the user is authenticated
    if (auth()->check()) {
        // User is authenticated, proceed with participation logic
        $user = auth()->user();

        // Implement your participation logic here, such as updating the pivot table
        $donationAmount = $request->input('donation_amount');

        // Attach the user to the donation with the provided amount
        $user->donations()->attach($donation->id, ['amount' => $donationAmount]);

        // Update the totalAmountRaised for the donation
        $donation->totalAmountRaised += $donationAmount;
        $donation->save();

        // Redirect the user back to the show view with a success message
        return redirect()->route('donations.show', ['id' => $donation->id])->with('success', 'You have successfully participated in the donation with an amount of ' . $donationAmount);
    } else {
        // User is not authenticated, handle this case (e.g., redirect to login)
        return redirect()->route('login')->with('error', 'You need to be logged in to participate in a donation.');
    }
}

public function donationHistory()
{
    // Get the authenticated user
    $user = auth()->user();

    // Get the donation history for the user, including amounts and descriptions
    $donationHistory = $user->donations;

    return view('donations.donation_history', ['donationHistory' => $donationHistory]);
}


public function showDonationHistory()
{
    // Replace this with the code to fetch the user's donation history
    $donationHistory = DonationHistory::where('user_id', auth()->user()->id)->get();

    return view('donations.donation-history', ['donationHistory' => $donationHistory]);
}

public function openedDonations()
{
    // Get the authenticated user
    $user = auth()->user();

    // Get donations created by the authenticated user
    $donations = Donation::where('user_id', $user->id)->get();

    return view('donations.opened_donations', compact('donations'));
}

public function destroy($id)
{
    // Find the donation by its ID
    $donation = Donation::find($id);

    if ($donation) {
        // Delete the donation
        $donation->delete();

        // Redirect to a page or route after successful deletion
        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully.');
    } else {
        // Handle the case where the donation is not found
        return redirect()->route('donations.index')->with('error', 'Donation not found.');
    }
}


public function updateTotalAmountRaised($donation)
{
    $totalAmountRaised = $donation->donors()->sum('amount');
    $donation->totalAmountRaised = $totalAmountRaised;
    $donation->is_complete = $totalAmountRaised >= $donation->target_amount;
    $donation->save();
}





}
