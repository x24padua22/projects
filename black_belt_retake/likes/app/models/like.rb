class Like < ActiveRecord::Base
  
  belongs_to :user, :foreign_key => :user_id
  belongs_to :idea, :foreign_key => :idea_id
  attr_accessible :idea_id, :user_id
end
