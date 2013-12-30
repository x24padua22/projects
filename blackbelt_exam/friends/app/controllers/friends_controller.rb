class FriendsController < ApplicationController
  def new
  	@invite = Invite.new(params[:invite])
  	
  	if @invite.save
  		flash[:notice] = "Successfully accepted friend invite!"
  	else
  		flash[:notice] = "Failed to accept the invite."
  	end

  	redirect_to users_path
  end

  def destroy
  	@friendship = Friendship.find(:id)
  	
  	if @friendship.destroy
  		notice: "Ignore success!"
  	else
  		notice: "Failed to ignore the invite."
  	end

  	redirect_to users_path
  end
end
