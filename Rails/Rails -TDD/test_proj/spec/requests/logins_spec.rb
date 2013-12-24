require 'spec_helper'

describe "Logins" do
  it "works! (now write some real specs)" do
    visit("http://localhost:3000/signup")
    fill_in("first_name", :with => "Zen")
    fill_in("last_name", :with => "Macapagal")
    fill_in("email", :with => "zen.macapagal@gmail.com")
    fill_in("description", :with => "This is a test description with at least 50 characters to pass validation.")
    fill_in("password", :with => "12345678")
    fill_in("password_confirmation", :with => "12345678")
    click_link_or_button("Create User")
  end
end
