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
      redirect_to users_path, notice: 'User was successfully created.'
    else
      render action: "new"
    end
  end

  def show
  	@user = User.find(params[:id])
    @comment = Comment.new
    @comments = Comment.where(:user_id => params[:id])
  end

  def destroy
    @user = User.find(params[:id])
    
    if @user.destroy
      flash[:notice] = "User has been deleted."
    else
      flash[:notice] = "Sorry, something went wrong and the user was not deleted."
    end

    @user = User.all
    redirect_to users_path
  end
end
