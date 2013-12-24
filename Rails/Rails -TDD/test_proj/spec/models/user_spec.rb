require 'spec_helper'

describe User do
  it "is valid with a first_name and last_name" do
    user = User.new(
      first_name: 'Zen',
      last_name: 'Macapagal',
      email: 'zen.macapagal@gmail.com')

    expect(user).to be_valid
  end
   
  it "is invalid without a firstname" do 
  	expect(User.new(firstname: nil)).to have(1).errors_on(:firstname)
  end

  it "is invalid without a lastname" do
  	expect(User.new(lastname: nil)).to have(1).errors_on(:lastname)
  end

  it "is invalid with a duplicate email address" do
	User.create(
		firstname: 'Zen', lastname: 'Macapagal',
		email: 'rozen@yahoo.com')

	user = User.new(
		firstname: 'Rozen', lastname: 'Macapagal',
		email: 'rozen@yahoo.com')
	
	expect(user).to have(1).errors_on(:email)
  end

  it "is invalid with an email address with incorrect format" do
    user = User.new(
		firstname: 'Zen', lastname: 'Macapagal',
		email: 'rozen.zen')

    expect(user).to have(1).errors_on(:email)
  end

  it "is invalid without a description" do
  	expect(User.new(description: nil)).to have(1).errors_on(:description)
  end

  it "validates if description is at least 50 characters long" do
  	user = User.new(description).is_at_least(50)

  	expect(user.description).to eq 'Zen Macapagal'
  end

  
end
