class IdeasController < ApplicationController
  def index
  	#showing all posts, ordered by the number of likes
  	@ideas = Idea.joins("LEFT JOIN likes ON likes.idea_id = ideas.id").
      group(:idea_id).order("count(likes.idea_id) DESC")
  	@idea = Idea.new
  	@like = Like.where(:idea_id => @idea.id)
  end

  def create
  	@idea = Idea.new(params[:idea])
  	@idea.user_id = current_user.id

  	if @idea.save
  		flash[:notice] = "Idea successfully posted!"
  	else
  		flash[:notice] = "Sorry, but your idea was not posted."
  	end

  	redirect_to :back
  end

  def show
  	@idea = Idea.find(params[:id])
  	@likes = Like.where(idea_id: params[:id])
  end
end
