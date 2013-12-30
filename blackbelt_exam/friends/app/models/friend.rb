class Friend < ActiveRecord::Base
  belongs_to :user, :foreign_key => :user_id
  belongs_to :user, :foreign_key => :friend_id
  attr_accessible :user_id, :friend_id
end
