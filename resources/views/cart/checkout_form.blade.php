<div id="checkoutArea" class="{{Cart::count() < 1 ? 'disabled' : ''}}">
	<form id="checkoutForm" action="{{route('checkout')}}" method="POST">
		{{csrf_field()}}

		<h3>
			Checkout Order
		</h3>

		<input type="text" required class="input" placeholder="Your Full Name" name="name" {{Auth::user() ? 'readonly' : ''}}
			value="{{Auth::user() ? Auth::user()->name : ''}}">

		<input type="text" required class="input" placeholder="Your Phone Number" name="phone_number"
			   {{Auth::user() ? 'readonly' : ''}}
			   value="{{Auth::user() ? Auth::user()->phone_number : ''}}">

		<select id="" required class="input" name="delivery_location_id">
			<option value="">Choose delivery Location</option>

			@foreach($locations as $location)
				<option value="{{$location->id}}">{{$location->location}}</option>
			@endforeach
		</select>

		<button type="submit" class="btn accent large block" style="text-transform: uppercase;">
			SUBMIT ORDER
		</button>
	</form>
</div>
