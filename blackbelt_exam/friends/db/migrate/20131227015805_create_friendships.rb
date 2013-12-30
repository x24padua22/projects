class CreateFriendships < ActiveRecord::Migration
  def change
    create_table :friendships do |t|
      t.references :user
      t.references :status
      t.integer :friend_id

      t.timestamps
    end
    add_index :friendships, :user_id
    add_index :friendships, :status_id
  end
end
