class FriendshipsController < ApplicationController
  include SessionsHelper

  def edit
    @friendship = Friendship.find(:id)
  end

  def update
  	@friendship = Friendship.find(params[:id])
  	
  	if @friendship.update_attributes(:status_id => 1)
  		flash[:notice] = "Successfully accepted friend invite!"
  	else
  		flash[:notice] = "Failed to accept the invite."
  	end	

  	redirect_to :back
    #render :text => params[:id]
  end

  def destroy
  	@friendship = Friendship.find(params[:id])
  	
  	if @friendship.destroy
  		flash[:notice] = "Ignore success!"
  	else
  		flash[:notice] = "Failed to ignore the invite."
  	end

  	redirect_to :back
  end

  def new
  	@friendship = Friendship.new
  end

  def create
  	@friendship = Friendship.new()
    @friendship.user_id = current_user.id
    @friendship.friend_id = params[:friend_id]
    @friendship.status_id = 2
    
    if @friendship.save
      flash[:notice] = "Friend invite sent"
    else
      flash[:notice] = "Sorry, but there seems to be an error in adding the user as friend."
    end

    redirect_to :back
  end
end
