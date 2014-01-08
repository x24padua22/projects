class CreateLikes < ActiveRecord::Migration
  def change
    create_table :likes do |t|
      t.references :idea
      t.references :user

      t.timestamps
    end
    add_index :likes, :idea_id
    add_index :likes, :user_id
  end
end
