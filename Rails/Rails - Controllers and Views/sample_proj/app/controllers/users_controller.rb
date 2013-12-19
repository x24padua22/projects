class UsersController < ApplicationController
  def index
  	@users = User.all
  end

  def new
  end

  def create
  	render :text => params
  end
end
