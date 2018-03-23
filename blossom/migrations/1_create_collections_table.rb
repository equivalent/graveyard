Sequel.migration do
  change do
    create_table(:collections) do
      primary_key :id
      String :filekey, null: false, size: 100, index: true
      String :title, null: false, size: 255
      String :description, text: true
      String :enc_private_msg, text: true
      String :year, null: false, size: 4
      String :month, null: false, size: 2
      String :day, null: false, size: 2
      DateTime :created_at, null: false
      String :status, size: 20
      String :documents_serial, text: true
    end
  end
end
