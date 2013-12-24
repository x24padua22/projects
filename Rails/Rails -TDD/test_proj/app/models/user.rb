class User < ActiveRecord::Base
  attr_accessor :password
  attr_accessible :description, :email, :password, :password_confirmation, :first_name, :last_name, :salt

  email_regex = /\A([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]+)\z/i

  validates :description, :email, :password, :password_confirmation, :first_name, :last_name, :presence => true
  validates :description, :length => { :minimum => 50 }
  validates :email, :format => { :with => email_regex }, :uniqueness => { :case_sensitive => false }
  validates :password, :confirmation => true, :length => { :within => 6..40 }

  before_save :encrypt_password

  def has_password?(submitted_password)
  	encrypted_password == encrypt(submitted_password)
  end

  def self.odd_records
    select {|x| x.id.odd? }
  end
  def self.even_records
  	select {|x| x.id.even?}
  end

  private
  	def encrypt_password
  		# generate a unique salt if it's a new user
  		self.salt = Digest::SHA2.hexdigest("#{Time.now.utc}--#{password}") if self.new_record?
  	
  		# encrypt the password and store that in the encrypted_password field
  		self.encrypted_password = encrypt(password)
  	end

  	# encrypt the password using both the salt and the passed password
  	def encrypt(pass)
  		Digest::SHA2.hexdigest("#{self.salt}--#{pass}")
  	end
end
