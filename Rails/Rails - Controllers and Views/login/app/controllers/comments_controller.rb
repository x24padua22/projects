class CommentsController < ApplicationController
  include SessionsHelper

  def new
  	@comment = Comment.new
  end

  def create
  	@comment = Comment.new(params[:comment])
    @comment.commenter_id = session[:user_id]
    
    if @comment.save!
      flash[:notice] = "Comment was successfully created."
    else
      flash[:notice] = @comment.errors.full_messages
    end

    @comments = Comment.all
    redirect_to :back
  end
end
