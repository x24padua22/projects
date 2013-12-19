class PostsController < ApplicationController
  def index
  	@posts = Post.all
  end

  def new
  end

  def create
  	render :text => params
  end
end
