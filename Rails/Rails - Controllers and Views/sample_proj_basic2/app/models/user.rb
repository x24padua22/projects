class User < ActiveRecord::Base
  has_secure_password
  attr_accessible :email, :first_name, :last_name, :password, :password_confirmation

  validates :email, :first_name, :last_name, :password, :password_confirmation, :presence => true
  validates :email, :uniqueness => true
  validates :first_name, :last_name, :length => { :minimum => 2 }
end
