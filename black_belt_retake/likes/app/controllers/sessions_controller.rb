class SessionsController < ApplicationController
	include SessionsHelper

	def create
	  	user = User.authenticate(params[:session][:email], params[:session][:password])

	  	if user.nil?
	  		flash.now[:error] = "Invalid email/password combination."
	  		render :new
	  	else
	  		sign_in user
	  		redirect_to ideas_path
	  	end
	end

	def destroy
  		sign_out
  		redirect_to login_path
	end
end
