class UsersController < ApplicationController
  def index
  	@users = User.all
  end

  def new
  	@user = User.new
  end

  def create
  	@user = User.new(params[:user])

  	if @user.save
      @users = User.all
      flash[:notice] = "You have successfully registered!"
  		render "new"
  	else
      flash[:errors] = @user.errors.full_messages
  		redirect_to new_user_path
  	end
  end

  def show
    @user = User.find(params[:id])
  end

  def edit
    @user = User.find(params[:id])
  end

  def update
    @user = User.find(params[:id])

    if @user.update_attributes(params[:user])
      @users = User.all
      flash[:notice] = "User information has been updated."
      redirect_to user_path
    else
      flash[:errors] = @user.errors.full_messages
      redirect_to edit_user_path
    end
  end

  def destroy
    @user = User.find(params[:id])

    if @user.destroy
      flash[:notice] = "User has been deleted."
    else
      flash[:notice] = "User was not deleted."
    end

    @users = User.all
    render "new"
  end
end
