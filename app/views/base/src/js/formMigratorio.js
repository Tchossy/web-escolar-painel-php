const inputPhotoUser = document.getElementById('inputPhotoUser')
const photoUser = document.getElementById('photoUser')

const visa_type_input = document.getElementById('visa_type')
const name_user_input = document.getElementById('name_user')
const marital_status_user_input = document.getElementById('marital_status_user')
const sex_user_input = document.getElementById('sex_user')
const date_birth_user_input = document.getElementById('date_birth_user')
const birthplace_user_input = document.getElementById('birthplace_user')
const country_birth_user_input = document.getElementById('country_birth_user')
const nationality_origin_user_input = document.getElementById(
  'nationality_origin_user'
)
const current_nationality_user_input = document.getElementById(
  'current_nationality_user'
)
const passaport_user_input = document.getElementById('passaport_user')
const place_issue_user_input = document.getElementById('place_issue_user')
const date_issue_user_input = document.getElementById('date_issue_user')
const valid_until_user_input = document.getElementById('valid_until_user')
const profession_user_input = document.getElementById('profession_user')
const position_held_user_input = document.getElementById('position_held_user')
const workplace_user_input = document.getElementById('workplace_user')
const household_user_input = document.getElementById('household_user')
const city_user_input = document.getElementById('city_user')
const road_user_input = document.getElementById('road_user')
const postal_Code_user_input = document.getElementById('postal_Code_user')
const fax_user_input = document.getElementById('fax_user')
const email_user_input = document.getElementById('email_user')
const phone_number_user_input = document.getElementById('phone_number_user')
const father_name_input = document.getElementById('father_name_user')
const father_nationality_user_input = document.getElementById(
  'father_nationality_user'
)
const mother_name_input = document.getElementById('mother_name_user')
const mother_nationality_user_input = document.getElementById(
  'mother_nationality_user'
)
const reason_travel_user_input = document.getElementById('reason_travel_user')
const hosting_place_user_input = document.getElementById('hosting_place_user')
const city_hosting_user_input = document.getElementById('city_hosting_user')
const road_hosting_user_input = document.getElementById('road_hosting_user')
const house_number_user_input = document.getElementById('house_number_user')
const name_person_responsible_stay_user_input = document.getElementById(
  'name_person_responsible_stay_user'
)
const person_contact_angola_user_input = document.getElementById(
  'person_contact_angola_user'
)
const full_addres_angola_user_input = document.getElementById(
  'full_addres_angola_user'
)
const entrance_date_angola_user_input = document.getElementById(
  'entrance_date_angola_user'
)
const border_post_be_used_user_input = document.getElementById(
  'border_post_be_used_user'
)
const exit_date_angola_user_input = document.getElementById(
  'exit_date_angola_user'
)
const signature_user_input = document.getElementById('signature_user')
const date_signature_user_input = document.getElementById('date_signature_user')

const visa_type_pdf_field = document.getElementById('visa_type_pdf')
const name_user_pdf_field = document.getElementById('name_user_pdf')
const marital_status_user_pdf_field = document.getElementById(
  'marital_status_user_pdf'
)
const sex_user_pdf_field = document.getElementById('sex_user_pdf')
const date_birth_user_pdf_field = document.getElementById('date_birth_user_pdf')
const birthplace_user_pdf_field = document.getElementById('birthplace_user_pdf')
const country_birth_user_pdf_field = document.getElementById(
  'country_birth_user_pdf'
)
const nationality_origin_user_pdf_field = document.getElementById(
  'nationality_origin_user_pdf'
)
const current_nationality_user_pdf_field = document.getElementById(
  'current_nationality_user_pdf'
)
const passaport_user_pdf_field = document.getElementById('passaport_user_pdf')
const place_issue_user_pdf_field = document.getElementById(
  'place_issue_user_pdf'
)
const date_issue_user_pdf_field = document.getElementById('date_issue_user_pdf')
const valid_until_user_pdf_field = document.getElementById(
  'valid_until_user_pdf'
)
const profession_user_pdf_field = document.getElementById('profession_user_pdf')
const position_held_user_pdf_field = document.getElementById(
  'position_held_user_pdf'
)
const workplace_user_pdf_field = document.getElementById('workplace_user_pdf')
const household_user_pdf_field = document.getElementById('household_user_pdf')
const city_user_pdf_field = document.getElementById('city_user_pdf')
const road_user_pdf_field = document.getElementById('road_user_pdf')
const postal_Code_user_pdf_field = document.getElementById(
  'postal_Code_user_pdf'
)
const phone_number_user_pdf_field = document.getElementById(
  'phone_number_user_pdf'
)
const email_user_pdf_field = document.getElementById('email_user_pdf')
const father_name_pdf_field = document.getElementById('father_name_pdf')
const father_nationality_user_pdf_field = document.getElementById(
  'father_nationality_user_pdf'
)
const mother_name_pdf_field = document.getElementById('mother_name_pdf')
const mother_nationality_user_pdf_field = document.getElementById(
  'mother_nationality_user_pdf'
)
const reason_travel_user_pdf_field = document.getElementById(
  'reason_travel_user_pdf'
)
const hosting_place_user_pdf_field = document.getElementById(
  'hosting_place_user_pdf'
)
const city_hosting_user_pdf_field = document.getElementById(
  'city_hosting_user_pdf'
)
const road_hosting_user_pdf_field = document.getElementById(
  'road_hosting_user_pdf'
)
const house_number_user_pdf_field = document.getElementById(
  'house_number_user_pdf'
)
const name_person_responsible_stay_user_pdf_field = document.getElementById(
  'name_person_responsible_stay_user_pdf'
)

inputPhotoUser.addEventListener('change', value => {
  const [file] = value.target.files

  if (file) {
    const namePhoto = file.name
    photoUser.src = URL.createObjectURL(file)
    photoUser.alt = namePhoto
    URL.revokeObjectURL(urlPhoto)
  }
})

const inputSendForm = document.getElementById('inputSendForm')

function changeTextPdf() {
  visa_type_pdf_field.innerText = visa_type_input.value
  name_user_pdf_field.innerText = name_user_input.value
  marital_status_user_pdf_field.innerText = marital_status_user_input.value
  sex_user_pdf_field.innerText = sex_user_input.value
  date_birth_user_pdf_field.innerText = date_birth_user_input.value
  birthplace_user_pdf_field.innerText = birthplace_user_input.value
  country_birth_user_pdf_field.innerText = country_birth_user_input.value
  nationality_origin_user_pdf_field.innerText =
    nationality_origin_user_input.value
  current_nationality_user_pdf_field.innerText =
    current_nationality_user_input.value
  passaport_user_pdf_field.innerText = passaport_user_input.value
  place_issue_user_pdf_field.innerText = place_issue_user_input.value
  date_issue_user_pdf_field.innerText = date_issue_user_input.value
  valid_until_user_pdf_field.innerText = valid_until_user_input.value
  profession_user_pdf_field.innerText = profession_user_input.value
  position_held_user_pdf_field.innerText = position_held_user_input.value
  workplace_user_pdf_field.innerText = workplace_user_input.value
  household_user_pdf_field.innerText = household_user_input.value
  city_user_pdf_field.innerText = city_user_input.value
  road_user_pdf_field.innerText = road_user_input.value
  postal_Code_user_pdf_field.innerText = postal_Code_user_input.value
  phone_number_user_pdf_field.innerText = phone_number_user_input.value
  email_user_pdf_field.innerText = email_user_input.value
  father_name_pdf_field.innerText = father_name_input.value
  father_nationality_user_pdf_field.innerText =
    father_nationality_user_input.value
  mother_name_pdf_field.innerText = mother_name_input.value
  mother_nationality_user_pdf_field.innerText =
    mother_nationality_user_input.value
  reason_travel_user_pdf_field.innerText = reason_travel_user_input.value
  hosting_place_user_pdf_field.innerText = hosting_place_user_input.value
  city_hosting_user_pdf_field.innerText = city_hosting_user_input.value
  road_hosting_user_pdf_field.innerText = road_hosting_user_input.value
  house_number_user_pdf_field.innerText = house_number_user_input.value
  name_person_responsible_stay_user_pdf_field.innerText =
    name_person_responsible_stay_user_input.value
}
function download() {}
