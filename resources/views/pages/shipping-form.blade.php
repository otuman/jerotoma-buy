

<div class="row">
  <div class="col-md-6">
        <div class="form-group">
          <label for="first_name">First Name:</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::check() ? $user->firstName : '' }}" required>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="first_name">Last Name:</label>
          <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::check() ? $user->lastName : '' }}" required>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="address_1">Address 1:</label>
          <input type="text" class="form-control" id="address_1" name="address_1" value="{{ Auth::check() && $user->shipping ? $user->shipping->address_1 : '' }}" required>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label for="address_2">Address 2:</label>
          <input type="text" class="form-control" id="address_2" name="address_2" value="{{ Auth::check() && $user->shipping ? $user->shipping->address_2 : '' }}" >
        </div>
        <div class="form-group">
          <label for="phone">Phone: </label>
           <input type="text" class="form-control" id="phone" name="phone"  value="{{ Auth::check() && $user->shipping ? $user->shipping->phone : '' }}" required>
           <div class="help-block with-errors"></div>
        </div>

  </div>
  <div class="col-md-6">
        <div class="form-group">
          <label for="city">City:</label>
           <input type="text" class="form-control" id="city" name="city"  value="{{ Auth::check() && $user->shipping ? $user->shipping->city : '' }}" required>
           <div class="help-block with-errors"></div>
        </div>
         <div class="form-group">
           <label for="state">Province:</label>
           <input type="text" class="form-control" id="state" name="state"  value="{{ Auth::check() && $user->shipping ? $user->shipping->state : '' }}" required>
           <div class="help-block with-errors"></div>
         </div>
         <div class="form-group">
           <label for="postal_code">Postal Code:</label>
           <input type="text" class="form-control" id="postal_code" name="postal_code"  value="{{ Auth::check() && $user->shipping ? $user->shipping->postal_code : '' }}" required>
          <div class="help-block with-errors"></div>
         </div>
         <div class="form-group">
           <label for="country">Country:</label>
           <input type="text" class="form-control" id="country" name="country"  value="{{ Auth::check() && $user->shipping ? $user->shipping->country_code : '' }}" required>
           <div class="help-block with-errors"></div>
         </div>
         <div class="checkbox">
           <label><input id="isDefault" type="checkbox" value="1">Check the box if you want this be your default shipping address</label>
         </div>
         <div class="form-group">
           <label for="special_note">Special Note:</label>
            <textarea type="" class="form-control" id="special_note" rows="3" name="special_note">{{ Auth::check() && $user->shipping ? $user->shipping->special_note : '' }}</textarea>
         </div>
  </div>
</div>
