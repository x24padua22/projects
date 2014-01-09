class LikesController < ApplicationController
	include SessionsHelper

	def create
		@like = Like.new()
		@like.idea_id = params[:idea_id]
		@like.user_id = current_user.id

		if @like.save
			flash[:notice] = "Liked!"
		else
			flash[:notice] = "Sorry, but there seems to be an error."
		end

		redirect_to :back
	end
end
