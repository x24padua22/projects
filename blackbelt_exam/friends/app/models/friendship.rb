class Friendship < ActiveRecord::Base

  belongs_to :user, :foreign_key => :friend_id
  belongs_to :user, :foreign_key => :user_id
  belongs_to :status, :foreign_key => :status_id
  attr_accessible :user_id, :friend_id, :status_id
end
