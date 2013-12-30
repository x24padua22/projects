class CreateStatuses < ActiveRecord::Migration
  def change
    create_table :statuses do |t|
      t.string :friendship_status

      t.timestamps
    end
  end
end
