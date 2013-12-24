class Comment < ActiveRecord::Base
  belongs_to :user, :foreign_key => :user_id
  belongs_to :user, :foreign_key => :commenter_id

  attr_accessible :commenter_id, :content, :user_id

  validates :content, :commenter_id, :user_id, :presence => true
end
