class Invite < ActiveRecord::Base
  belongs_to :user, :foreign_key => :user_id
  belongs_to :user, :foreign_key => :invited_id
  attr_accessible :user_id, :invited_id
end
