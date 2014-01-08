class Idea < ActiveRecord::Base
  belongs_to :user, :foreign_key => :user_id
  attr_accessible :content, :user_id
  has_many :likes
  has_many :users, :through => :likes
end
