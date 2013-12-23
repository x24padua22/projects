class CommentsController < ApplicationController
  def index
  	@comments = Comment.all
  end

  def new
    @comment = Comment.new
  end

  def create
    @comment = Comment.new(params[:comment])

    if @comment.save
      @comment = Comment.all
      flash[:notice] = "You have successfully added a new comment!"
      redirect_to comments_path
    else
      flash[:errors] = @comment.errors.full_messages
      redirect_to :back
    end

  end

  def show
    @comment = Comment.find(params[:id])
  end

  def edit
    @comment = Comment.find(params[:id])
  end

  def update
    @comment = Comment.find(params[:id])

    if @comment.update_attributes(params[:comment])
      @comments = Comment.all
      flash[:notice] = "Comment information has been updated."
      redirect_to comments_path
    else
      flash[:errors] = @comment.errors.full_messages
      redirect_to edit_comment_path
    end
  end

  def destroy
  	
  end
end
