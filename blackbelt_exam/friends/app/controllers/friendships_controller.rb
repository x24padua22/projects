class FriendshipsController < ApplicationController
  def edit
    @friendship = Friendship.find(:id)
  end

  def update
  	@friendship = Friendship.find(:id)
  	
  	if @friendship.update_attributes(:status_id => 1)
  		flash[:notice] = "Successfully accepted friend invite!"
  	else
  		flash[:notice] = "Failed to accept the invite."
  	end	

  	render "show"
  end

  def destroy
  	@friendship = Friendship.find(:id)
  	
  	if @friendship.destroy
  		flash[:notice] = "Ignore success!"
  	else
  		flash[:notice] = "Failed to ignore the invite."
  	end

  	redirect_to users_path
  end

  def new
  	@friendship = Friendship.new
  end

  def create
  	@friendship = Friendship.new(params[:friendship])
    
    if @friendship.save
      redirect_to users_path, notice: 'friend invite sent'
    else
      render action: "new"
    end
  end
end
