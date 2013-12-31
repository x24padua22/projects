class UsersController < ApplicationController
  include SessionsHelper

  def index
    @users = Array.new()
    @user = User.find(current_user)
    @friends1 = Friendship.where(:user_id => current_user, :status_id => 1)
    
      if @friends1
        @friends1.each do |friend|
          @users << friend.friend_id
        end
      end
    
    @friends2 = Friendship.where(:friend_id => current_user, :status_id => 1)
    
      if @friends2
        @friends2.each do |friend|
          @users << friend.user_id
        end
      end

    @invites = Friendship.where(:friend_id => current_user, :status_id => 2)
    
      if @invites
        @invites.each do |invite|
          @users << invite.user_id
        end
      end
    
    invites2 = Friendship.where(:user_id => current_user, :status_id => 2)
    
      if invites2
        invites2.each do |invite|
          @users << invite.friend_id
        end
      end
  	
    @others = User.find(:all, :conditions => ["id NOT IN (?) and id NOT IN (?)", @users, current_user])
  end

  def new
  	@user = User.new
  end

  def create
  	@user = User.new(params[:user])
    
    if @user.save
      sign_in @user
      @user = User.find(current_user)
      @friends = Friendship.where(:user_id => current_user, :status_id => 1)
      @invites = Friendship.where(:friend_id => current_user, :status_id => 2)
      @users = User.all
      redirect_to users_path
    else
      render action: "new"
    end
  end

  def show
    @user = User.find(current_user)
    friend_ids = Array.new
    friends1 = Friendship.where(:user_id => current_user, :status_id => 1)

    if friends1
      friends1.each do |friend|
        friend_ids << friend.friend_id
      end
    end
    
    friends2 = Friendship.where(:friend_id => current_user, :status_id => 1)

    if friends2
      friends2.each do |friend|
        friend_ids << friend.user_id
      end
    end

    @friends = User.where(:id => friend_ids)
  end
end
