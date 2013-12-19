class User < ActiveRecord::Base
  attr_accessible :email, :first_name, :last_name, :password_digest

  validates :email, :first_name, :last_name, :presence => true
  validates :email, :uniqueness => true
  validates :first_name, :last_name, :length => { :minimum => 2 }

  has_secure_password
end
