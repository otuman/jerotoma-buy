

<div class="row">
  <div class="col m6">
        <div class="input-field">
          <input placeholder="First Name" type="text" class="validate" id="first_name" name="first_name" value="{{ Auth::check() ? $user->firstName : '' }}" required>
          <label for="first_name">First Name:</label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="input-field">
          <input type="text"  placeholder="Last Name" class="validate" id="last_name" name="last_name" value="{{ Auth::check() ? $user->lastName : '' }}" required>
          <label for="last_name">Last Name:</label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="input-field">
          <input type="text" placeholder="Street Address" class="validate" id="address_1" name="address_1" value="{{ Auth::check() && $user->shipping ? $user->shipping->address_1 : '' }}" required>
          <label for="address_1">Address 1:</label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="input-field">
          <input type="text"  placeholder="# of apartment or unit" class="validate" id="address_2" name="address_2" value="{{ Auth::check() && $user->shipping ? $user->shipping->address_2 : '' }}" >
          <label for="address_2">Address 2:</label>
        </div>
        <div class="input-field">
           <input type="text"  placeholder="Phone" class="validate" id="phone" name="phone"  value="{{ Auth::check() && $user->shipping ? $user->shipping->phone : '' }}" required>
           <label for="phone">Phone: </label>
           <div class="help-block with-errors"></div>
        </div>

  </div>
  <div class="col m6">
        <div class="input-field">
           <input type="text"  placeholder="City" class="validate" id="city" name="city"  value="{{ Auth::check() && $user->shipping ? $user->shipping->city : '' }}" required>
           <label for="city">City:</label>
           <div class="help-block with-errors"></div>
        </div>
         <div class="input-field">
           <input type="text"  placeholder="Province" class="validate" id="state" name="state"  value="{{ Auth::check() && $user->shipping ? $user->shipping->state : '' }}" required>
           <label for="state">Province:</label>
           <div class="help-block with-errors"></div>
         </div>
         <div class="input-field">
           <input type="text"  placeholder="Postal Code" class="validate" id="postal_code" name="postal_code"  value="{{ Auth::check() && $user->shipping ? $user->shipping->postal_code : '' }}" required>
           <label for="postal_code">Postal Code:</label>
           <div class="help-block with-errors"></div>
         </div>
         <div class="input-field">
           <input type="text"  placeholder="Country" class="validate" id="country" name="country"  value="{{ Auth::check() && $user->shipping ? $user->shipping->country_code : '' }}" required>
           <label for="country">Country:</label>
           <div class="help-block with-errors"></div>
         </div>
         <div class="input-field">
            <textarea class="materialize-textarea" id="special_note" rows="3" name="special_note">{{ Auth::check() && $user->shipping ? $user->shipping->special_note : '' }}</textarea>
            <label for="special_note">Special Note:</label>
         </div>
         <div class="checkbox">
             <input id="isDefault" type="checkbox" value="1">
             <label for="isDefault">Is this your default shipping address</label>
         </div>
  </div>
</div>
