class CreateInvites < ActiveRecord::Migration
  def change
    create_table :invites do |t|
      t.references :user
      t.integer :invited_id

      t.timestamps
    end
    add_index :invites, :user_id
  end
end
